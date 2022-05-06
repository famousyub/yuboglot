#!/usr/local/bin/perl -w

use LWP::UserAgent;
use Crypt::SSLeay;
use HTTP::Cookies;
use HTTP::Headers;
use HTTP::Request;
use HTTP::Response;
use Time::HiRes 'time','sleep';

# constants:

$DEBUG       = 0;
$browser     = 'Mozilla/4.04 [en] (X11; I; Patrix 0.0.0 i586)';
$rooturl     = 'https://patrick.net';
$user        = "pk";
$password    = "pw";
$gnuplot     = "/usr/local/bin/gnuplot";

# global objects:

$cookie_jar  = HTTP::Cookies-&gt;new;
$ua          = LWP::UserAgent-&gt;new;

MAIN: {
  $ua-&gt;agent($browser); # This sets browser for all uses of $ua.

  # home page
  $latency = &amp;get("/home.html");
  # verify that we got the page
  $latency = -1 unless index "&lt;title&gt;login page&lt;/title&gt;" &gt; -1;
  &amp;log("home.log", $latency);
  sleep 2;

  $content = "user=$user&amp;passwd=$password";

  # log in
  $latency = &amp;post("/login.cgi", $content);
  $latency = -1 unless m|&lt;title&gt;welcome&lt;/title&gt;|;
  &amp;log("login.log", $latency);
  sleep 2;

  # content page
  $latency = &amp;get("/content.html");
  $latency = -1 unless m|&lt;title&gt;the goodies&lt;/title&gt;|;
  &amp;log("content.log", $latency);
  sleep 2;

  # logout
  $latency = &amp;get("/logout.cgi");
  $latency = -1 unless m|&lt;title&gt;bye&lt;/title&gt;|;
  &amp;log("logout.log", $latency);

  # plot it all
  `$gnuplot /home/httpd/public_html/demo.gp`;
}

sub get {
  local ($path) = @_;

  $request = new HTTP::Request('GET', "$rooturl$path");

  # If we have a previous response, put its cookies in the new request.
  if ($response) {
      $cookie_jar-&gt;extract_cookies($response);
      $cookie_jar-&gt;add_cookie_header($request);
  }

  if ($DEBUG) {
      print $request-&gt;as_string();
  }

  # Do it.
  $start    = time();
  $response = $ua-&gt;request($request);
  $end      = time();
  $latency  = $end - $start;

  if (!$response-&gt;is_success) {
      print $request-&gt;as_string(), " failed: ",
      $response-&gt;error_as_HTML;
  }

  if ($DEBUG) {
      print "\n## Got $path and result was:\n";
      print $response-&gt;content;
      print   "## $path took $latency seconds.\n";
  }

  $latency;
}

sub post {

  local ($path, $content) = @_;

  $header  = new HTTP::Headers;
  $header-&gt;content_type('application/x-www-form-urlencoded');
  $header-&gt;content_length(length($content));

  $request = new HTTP::Request('POST',
                               "$rooturl$path",
                               $header,
                               $content);

  # If we have a previous response, put its cookies in the new request.
  if ($response) {
      $cookie_jar-&gt;extract_cookies($response);
      $cookie_jar-&gt;add_cookie_header($request);
  }

  if ($DEBUG) {
      print $request-&gt;as_string();
  }

  # Do it.
  $start    = time();
  $response = $ua-&gt;request($request);
  $end      = time();
  $latency  = $end - $start;

  if (!$response-&gt;is_success) {
      print $request-&gt;as_string(), " failed: ", $response-&gt;error_as_HTML;
  }

  if ($DEBUG) {
      print "\n## Got $path and result was:\n";
      print $response-&gt;content;
      print   "## $path took $latency seconds.\n";
  }

  $latency;
}

# Write log entry in format that gnuplot can use to create an image.
sub log {

  local ($file, $latency) = @_;
  $date = `date +'%Y %m %d %H %M %S'`;
  chop $date;
  # Corresponding to gnuplot command: set timefmt "%m %d %H %M %S %y"

  open(FH, "&gt;&gt;$file") || die "Could not open $file\n";

  # Format printing so that we get only 4 decimal places.
  printf FH "%s %2.4f\n", $date, $latency;

  close(FH);
}
