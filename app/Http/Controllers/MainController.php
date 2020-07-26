<?php

namespace App\Http\Controllers;

use App\Container;
use App\Imports\TradeflowImport;
use App\Tradeflow;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    /**
     * Show dashboard with statistics
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tradeflows_total = Tradeflow::count();
        $tradeflows_without_containers = Tradeflow::doesntHave('containers')->count();
        $total_containers = Container::count();
        $invalid_containers = Container::invalid()->count();

        return view('index')->with(
            compact('tradeflows_total', 'tradeflows_without_containers', 'total_containers', 'invalid_containers')
        );
    }

    /**
     * Show tradeflows filtered by selected filter
     * See allowed filters in Tradeflow::$filters
     *
     * @param $filter
     * @return \Illuminate\View\View
     */
    public function tradeflows($filter)
    {
        // set default filter if unknown one given
        if (!in_array($filter, Tradeflow::$filters)){
            $filter = 'all';
        }
        $tradeflows = Tradeflow::query();

        if ($filter == 'without-containers'){
            $tradeflows->doesntHave('containers');
        }
        else{
            $tradeflows->with(['containers' => function($query){
                $query->orderBy('reference');
            }]);
        }
        $tradeflows = $tradeflows->orderBy('name')->paginate(10);

        return view('tradeflows')->with(compact('tradeflows', 'filter'));
    }

    /**
     * Show containers filtered by selected filter
     * See allowed filters in Container::$filters
     *
     * @param $filter
     * @return \Illuminate\View\View
     */
    public function containers($filter)
    {
        // set default filter if unknown one given
        if (!in_array($filter, Container::$filters)){
            $filter = 'all';
        }
        $containers = Container::query();

        // take only invalids
        if ($filter == 'invalid'){
            $containers->invalid();
        }
        $containers = $containers->paginate(10);

        return view('containers')->with(compact('containers'));
    }

    /**
     * Import excel file with shipping information
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:xlsx,xls'
        ];
        $this->validate($request, $rules);

        Excel::import(new TradeflowImport, $request->file('file'));

        return back()->with('success', 'Data successfully imported');
    }
}
