<p align="center"><a href="https://www.guildmortgage.com/" target="_blank"><img src="https://www.guildmortgage.com/wp-content/uploads/2016/11/Guild_Logo_RGB_Full.png" width="25%"></a></p>

# Developer test for Guild / Laravel

## Given

- You have a loan application
  - The loan application has 2 borrowers
    - One borrower has a job
    - The other borrower has a job and a bank account

## Requirements

- Fork this git repository and create a feature branch for your changes
- Install a fresh copy of Laravel
- Create some simple database tables to represent the above scenario
  - By simple I mean just the basics of what's really needed for this exercise
  - For example, the borrower should have a name, but we don't need date of birth, social security number or contact information for this exercise
  - Though I would like to see the standard date fields as part of the design (ie. created, updated, deleted)
- Write a query (or queries) that shows the total annual income and bank account values for the application
- Expose an API end point to show the results of the query (or queries)
  - All output should be in JSON format
- Write a unit test on at least one method in the project
  - I'm deliberatly keeping this requirement vague to give you freedom to decide what to test and how
- Update this README file with any installation instructions needed so we can clone and run your code
- Create a Github Pull Request against this repo with your changes

## What we're looking for

- Your general skill-set with PHP and MySQL
- Your general architecture skills
- How well you know your way around Laravel
- Your ability to write unit tests
- Coding style
- How well you adhere to the PSR standards
- Usage of design patterns in your code

## Installation instructions

# Installation instructions
# Prerequisites
* To run this project, you must have PHP 8 installed.

#Step 1

Begin by cloning this repository to your machine and switch to feature branch, and installing all Composer dependencies.

cd loanapp && composer install
php artisan migrate
php artisan db:seed --class=LoanApplicationSeeder


# Step 2

Serving Laravel

php artisan artisan:serve

# Step 3

Run Test Cases

php artisan test

or

vendor/bin/phpunit


# Step 4 - Create Loan Application API

POST: api/loan-application/store-loan-application

Payload Example:
```json
{
  "loan_application_number": "ABC100",
  "loan_amount": "100",
  "borrowers" : [{
"name":"sudheesh", 
"email":"sudheesh@gmail.com",
"employment": {
       "employer_name":"employerName",
       "employer_address":"employerAdd",
       "annual_income":"1500"
     },
"bank_account": {
       "bank_name":"bank_name",
       "account_type":"checking",
       "balance_amount":"2000"
     }
},
{
"name":"deepthi", 
"email":"deepthi@gmail.com",
"employment": {
       "employer_name":"employerName1",
       "employer_address":"employerAdd1",
       "annual_income":"3000"
     }
}
]
}
```

# Step 5 - Get Loan Application API

GET: api/loan-application/get-loan-application/{$loan_application_id}


# Step 6 - Get Annual Income and Bank Balance API

GET: api/loan-application/get-total-annual-income/{$loan_application_id}



