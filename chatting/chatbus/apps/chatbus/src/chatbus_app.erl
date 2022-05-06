%%%-------------------------------------------------------------------
%% @doc chatbus public API
%% @end
%%


%%Dispatch = cowboy_router:compile(
  %%           [{'_', [
%%                     {"/", cowboy_static, {priv_file, chatbus, "index.html"}},
%%                     {"/ws", ws_handler, []},
%%                     %{"/static/[...]", cowboy_static, {priv_dir, chatbus, "static"}}
%%                     {"/[...]", cowboy_static, {priv_dir, chatbus, "./"}}

  %%                  ]}
%%             ]),
%%{ok, _} = cowboy:start_http(http, 100, [{port, 9090}], [{env, [{dispatch, Dispatch}]}]),
%
%%%-------------------------------------------------------------------

-module(chatbus_app).

-behaviour(application).

-export([start/2, stop/1]).

start(_StartType, _StartArgs) ->

   Dispatch = cowboy_router:compile([
        { <<"localhost">>, [{<<"/">>, chatbus_handler, []}] }
    ]),
    {ok, _} = cowboy:start_clear(
        ello_listener,
        [{port, 8085}],
        #{env => #{dispatch => Dispatch}}
    ),
    chatbus_sup:start_link().

%   Dispatch = cowboy_router:comile([

%     { "localhost" ,[{"/",chatbus_handler,[]}]}

%   ]),
% %%ok = application:ensure_started(ebus),

%   % Dispatch = cowboy_router:compile([
%   %      { <<"localhost">>, [{<<"/">>, hello_handler, []}] }
%   %  ]),
%    {ok, _} = cowboy:start_clear(

%        ello_listener,
%        [{port, 8080}],
%        #{env => #{dispatch => Dispatch}}
%    ),

% %% taken from cowboy websocket tutorial

%     chatbus_sup:start_link().

stop(_State) ->
    ok.

%% internal functions
