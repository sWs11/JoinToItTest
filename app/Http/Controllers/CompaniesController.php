<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\SaveCompany;
use App\Mail\CreateCompanyMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::orderBy('companies.id', 'DESC')->paginate(10);

        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveCompany $saveCompany
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveCompany $saveCompany)
    {
        if(!is_null($saveCompany->logo)) {
            $logo_path = 'storage/company_logos/' . $this->uploadFile($saveCompany->logo);
        }

        Company::create([
            'name' => $saveCompany->name,
            'email' => $saveCompany->email,
            'logo' => isset($logo_path) ? $logo_path : null,
            'website' => $saveCompany->website
        ]);

        if(!empty($saveCompany->email)) {
            Mail::to($saveCompany->email)->send(new CreateCompanyMail($saveCompany->name));
        }

        return redirect()->back()->with('success', 'Company created successfully.');
    }

    /**
     * Upload company logo to storage
     *
     * @param UploadedFile $file
     * @return string
     */
    private function uploadFile(UploadedFile $file) {
        $filename = time() . '.' . $file->extension();

        $file->move(storage_path('app/public/company_logos'), $filename);

        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveCompany $storeCompany
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveCompany $storeCompany, $id)
    {
        $company = Company::findOrFail($id);

        if(!is_null($storeCompany->logo)) {
            $logo_path = 'storage/company_logos/' . $this->uploadFile($storeCompany->logo);
        } else {
            $logo_path = !empty($storeCompany->exist_image) ? $company->logo : null;
        }

        $company->fill([
            'name' => $storeCompany->name,
            'email' => $storeCompany->email,
            'logo' => $logo_path,
            'website' => $storeCompany->website
        ]);

        $company->save();

        return redirect()->back()->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return redirect()->back()->with('success', 'Company deleted successfully.');
    }

    /**
     * Get list of companies for select2 (on pages create/update employees)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanies(Request $request) {
        $page = $request->get('page', 1);
        $query = $request->get('q');
        $limit = 30;

        $companies = Company::selectRaw('SQL_CALC_FOUND_ROWS id')
            ->addSelect(['name'])
            ->where('name', 'like', $query . '%')
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get()
        ;

        $total = Company::selectRaw('FOUND_ROWS() AS total')->first()->total;

        return response()->json([
            'data' => $companies->toArray(),
            'total' => $total
        ]);
    }
}
