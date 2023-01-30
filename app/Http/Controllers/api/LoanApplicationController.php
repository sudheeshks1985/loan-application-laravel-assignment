<?php

namespace App\Http\Controllers\api;
use App\Http\Resources\LoanApplicationCollection;
use App\Http\Resources\LoanApplicationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LoanApplication;
use App\Models\Borrower;
use App\Models\Employment;
use App\Models\BankAccount;

class LoanApplicationController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new LoanApplicationCollection(LoanApplication::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLoanApplication(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'loan_application_number' => 'required|max:100|unique:loan_applications',
            'loan_amount' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        $loanapplication = LoanApplication::create($data);
        if(!empty($request->input('borrowers'))){
            $borrowers = json_decode($request->input('borrowers', ''),true);
            
            foreach($borrowers as $borrower_data){
                $borrower = $loanapplication->borrowers()->create($borrower_data);
                //store employment data
                if(!empty($borrower_data['employment'])){
                    $employment_data = $borrower_data['employment'];
                    $employment = new Employment();
                    $employment->employer_name = $employment_data['employer_name'];
                    $employment->employer_address = $employment_data['employer_address'];
                    $employment->annual_income = $employment_data['annual_income'];
                    $employment->borrower_id = $borrower->id;
                    $employment->save();
                }
                
                //store bank account data
                if(!empty($borrower_data['bank_account'])){
                    $bank_account_data = $borrower_data['bank_account'];
                    $bank_account = new BankAccount();
                    $bank_account->bank_name = $bank_account_data['bank_name'];
                    $bank_account->account_type = $bank_account_data['account_type'];
                    $bank_account->balance_amount = $bank_account_data['balance_amount'];
                    $bank_account->borrower_id = $borrower->id;
                    $bank_account->save();
                }
                
            }
            
            
        }
        

        return response(['LoanApplication' => new LoanApplicationResource($loanapplication), 'message' => 'Loan Application created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanApplication  $loanapplication
     * @return \Illuminate\Http\Response
     */
    public function getLoanApplication($loan_application_id)
    {
        
        $loanapplication = LoanApplication::find($loan_application_id);
        return response(['LoanApplication' => new LoanApplicationResource($loanapplication)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanApplication  $loanapplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApplication $loanapplication)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'loan_application_number' => 'required|max:100|unique:loan_applications',
            'loan_amount' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'message' => 'Validation Error']);
        }

        $loanapplication->update($data);

        return response(['LoanApplication' => new LoanApplicationResource($loanapplication), 'message' => 'Loan Application details updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanApplication  $loanapplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanapplication)
    {
        $loanapplication->delete();

        return response(['message' => 'Loan Application deleted successfully']);
    }

    /**
     * get totaal Annual Income for the application.
     *
     * @param  \App\Models\LoanApplication  $loanapplication
     * @return \Illuminate\Http\Response
     */

    public function getTotalAnnualIncome($loan_application_id)
    {
        
        //find total annual income from employment
        $totalAnnualIncome = LoanApplication::find($loan_application_id)->employment()->sum('annual_income');
        
        //find total bank balance
        $totalBankBalance = LoanApplication::find($loan_application_id)->bankAccount()->sum('balance_amount');
        
        return response(['totalAnnualIncome' => $totalAnnualIncome,'totalBankBalance'=>$totalBankBalance]);
    }

    
}
