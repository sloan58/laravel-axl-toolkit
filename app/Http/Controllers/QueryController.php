<?php

namespace App\Http\Controllers;

use App\Query;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sql.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate that the 'statement' form element
        // is populated when POSTing to this method
        $request->validate([
            'statement' => 'required',
        ]);

        // Extract the 'statement' into a var
        $statement = request()->get('statement');

        // Create our AXL SOAP Client
        // You should load the WSDL files to:
        // storage/wsdl
        $client = new \SoapClient(storage_path('schema/10.5/AXLAPI.wsdl'), [
            // backtrace faults
            'trace' => true,
             // throw SoapFault exceptions
            'exceptions' => true,
            // The CUCM IP URL
            'location' => 'https://10.175.200.10:8443/axl/',
            // AXL Username
            'login' => 'Admin',
            // AXL Password
            'password' => 'Password',
            // Ignore self-signed certificates
            // and permit SHA1 ciphers (needed for older CUCM versions)
            'stream_context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'ciphers' => 'SHA1'
                    ]
                ]
            ),
        ]);

        // Find a local query that matches the statement
        // or create a new record
        $query = Query::firstOrCreate([
            'statement' => $statement
        ]);

        // Update the timestamps
        // We'll use timestamps to sort these in the view
        $query->touch();

        // Send the AXL SOAP message off to CUCM
        try {
            $response = $client->executeSqlQuery([
                'sql' => $statement
            ]);
        // Catch SoapFaults and return back with the error message
        } catch(\SoapFault $e) {
            flash($e->getMessage())->error();
            return back();
        }
        
        // Analyze the reponse from CUCM
        // If we received some 'rows'....
        if (isset($response->return->row)) {
            // See if the format is an array or object.
            // Array means we have multiple rows and object means we matched one row
            // If only one, we format the object as a single member of an associative array
            // This is so we can iterate them in the view and create our table
            $rows = is_array($response->return->row) ? $response->return->row : [$response->return->row];
            // Get the columns that we requested to use as the table headers
            $headers = array_keys(get_object_vars($rows[0]));
            // Return our view with 'headers' and 'rows' for the table
            return view('sql.index', compact('headers', 'rows'));
        // We didn't receive any results from CUCM.
        // Return back with no data
        } else {
            flash("No records found")->info();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function destroy(Query $query)
    {
        //
    }
}
