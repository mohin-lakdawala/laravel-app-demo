<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Games\UpdateRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * List all games.
     *
     * @return mixed
     */
    public function index()
    {
        return auth()->user()->games()->with('logs')->latest()->get();
    }

    /**
     * Store a new game.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return auth()->user()->games()->create([
            'started_at' => now(),
            'player_life' => 100,
            'dragon_life' => 100,
        ]);
    }

    /**
     * Update an existing game.
     *
     * @param UpdateRequest $request
     * @param Game $game
     * @return Game
     */
    public function update(UpdateRequest $request, Game $game)
    {
        $game->update([
            'finished_at' => now(),
            'player_life' => $request->get('playerLife'),
            'dragon_life' => $request->get('dragonLife'),
        ]);

        foreach ($request->get('logs') as $log) {
            $game->logs()->create([
                'text' => $log,
            ]);
        }

        return $game;
    }
}
