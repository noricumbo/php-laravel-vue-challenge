<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Teams/Index', [
            'teams' => Team::query()
                ->orderBy('id', 'asc')
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($team) => [
                    'id' => $team->id,
                    'name' => $team->name,
                    'slug' => $team->slug,
                    'color' => $team->color,
                ]),
            'filters' => request()->only(['search_filter', 'search', 'column', 'order'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        $team_resource = new TeamResource($team);

        $team_members = $this->getTeamMembers($team->id);

        return Inertia::render('Teams/Show', [
            'team' => $team_resource,
            'members' => $team_members,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $team_resource = new TeamResource($team);

        return Inertia::render('Teams/Edit', [ 'team' => $team_resource]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        $team->update($validated);

        return redirect('/teams/' . $request->team_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $this->removeMembersFromTeam($team->id);
        $team->delete();
        return redirect('/teams');
    }

    public function getTeamMembers($id)
    {
        return User::query()
            ->select('id', 'name')
            ->where('users.team_id', '=', $id)
            ->get();
    }

    public function removeMembersFromTeam($id) {
        $members = $this->getTeamMembers($id);

        foreach( $members as $member )
        {
            $member = User::findOrFail($member['id']);
            $member->team_id = null;
            $member->save();
        }
    }

    public function selectMembers()
    {
        $members = [];

        if( !empty(request()->search) )
        {
            $members = User::query()
                ->select('id', 'name')
                ->where('name', 'ilike', '%' . request()->search . '%')
                ->limit(25)
                ->get()->toArray();
        }

        return Inertia::render('Teams/SelectMembers', [
            'members' => $members,
        ]);
    }

    public function saveMembers(Request $request) {
        $request->validate([
            'team_name' => 'required',
            'team_color' => 'required',
        ]);

        $team = Team::findOrFail($request->team_id);
        $team->name = $request->team_name;
        $team->color = $request->team_color;
        $team->save();

        $this->removeMembersFromTeam($request->team_id);

        foreach( $request->team_members as $member )
        {
            $member = User::findOrFail($member['id']);
            $member->team_id = $team->id;
            $member->save();
        }

        return redirect('/teams/' . $request->team_id);
    }
}
