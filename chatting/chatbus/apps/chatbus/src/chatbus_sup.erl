%%%-------------------------------------------------------------------
%% @doc chatbus top level supervisor.
%% @end
%%%-------------------------------------------------------------------

-module(chatbus_sup).

-behaviour(supervisor).

-export([start_link/0]).

-export([init/1]).

-define(SERVER, ?MODULE).

-define(CHILD(Id, Mod, Args, Restart, Type), {Id, {Mod, start_link, Args},
                                              Restart, 60000, Type, [Mod]}).

-define(SIMPLE_CHILD(WorkerMod), ?CHILD(WorkerMod, WorkerMod, [], transient,
                                        worker)).

start_link() ->
    supervisor:start_link({local, ?SERVER}, ?MODULE, []).

%% sup_flags() = #{strategy => strategy(),         % optional
%%                 intensity => non_neg_integer(), % optional
%%                 period => pos_integer()}        % optional
%% child_spec() = #{id => child_id(),       % mandatory
%%                  start => mfargs(),      % mandatory
%%                  restart => restart(),   % optional
%%                  shutdown => shutdown(), % optional
%%                  type => worker(),       % optional
%%                  modules => modules()}   % optional
init([]) ->
    %%{ok, { {one_for_all, 10, 60}, [?SIMPLE_CHILD(bus_manager)]} }.

  SupFlags = #{strategy => one_for_all,
                 intensity => 0,
                 period => 1},
    ChildSpecs = [],
    {ok, {SupFlags, ChildSpecs}}.

%% internal functions
