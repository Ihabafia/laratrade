<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyEnum;
use App\Enums\Enums;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfoliotRequest;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all();

        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortfolioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortfolioRequest $request)
    {
        $user = auth()->user();
        $portfolio = $user->portfolios()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $portfolio->assets()->createMany($this->cashAsset($user));

        updateSession();

        return to_route('portfolios.index')
            ->withSuccess(__('custom-messages.model-created', ['model' => 'portfolio']))
            ->withNew($portfolio->id);
    }

    public function get(Request $request)
    {
        $portfolio = Portfolio::find($request->id);

        return response([
            'CAD' => $portfolio->CAD,
            'USD' => $portfolio->USD,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePortfoliotRequest  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortfoliotRequest $request, Portfolio $portfolio)
    {
        $portfolio->update($request->validated());

        updateSession();

        return to_route('portfolios.index')
            ->withSuccess(__('custom-messages.model-updated', ['model' => 'portfolio']))
            ->withUpdated($portfolio->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }

    private function cashAsset($user): array
    {
        return array([
            'user_id' => $user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Account in CAD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::CAD,
        ],
        [
            'user_id' => $user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Account in USD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::USD,
        ]);
    }
}
