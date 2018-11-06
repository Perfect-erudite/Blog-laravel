<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all list of companies
        //$companies = company::all();
        if(Auth::check()){
            $companies = Company::where('user_id', Auth::user()->id)->get();
            //Pass view to laravel
            return view('companies.index', ['companies'=>$companies]);
        }
        return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Checks if user is logged in and is in the database
        if(Auth::check()){
            //This enables user to create a company
            $company = Company::create([   //A variable to create a company into the companies database
                'name' => $request->input('name'),  //The company's name to be inserted into the database
                'description' => $request->input('description'),  
                'user_id' => Auth::user()->id
            ]);



            //Once the company is created successfully, its redirect the user to company's page with a success message
            if($company){
                return redirect()->route('companies.show', ['company'=>$company->id])
                ->with('success', 'Company created successfully');
            }
        }

        //This returns an error message if the company cannot be created and redirects back to the company creating page
        return back()->withInput()->with('errors', 'Error in creating new Company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //$company = Company::where('id', $company->id)->first();
        $company = Company::find($company->id);
        return view('companies.show', ['company'=>$company]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.edit', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //Save data
        $CompanyUpdate = Company::where('id', $company->id)->update([
            "name"=> $request->input('name'),
            "description"=> $request->input('description')
        ]);

        if($CompanyUpdate){
            return redirect()->route('companies.show', ['company'=>$company->id])->with('success', 'Company update successful');
        }
        //redirect 
        return back()->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
         $findCompany = Company::find( $company->id);
         if($findCompany->delete()){

            //redirect
            return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
         }

         return back()->withInput()->with('errors', 'Company could not be deleted');
    }
}
