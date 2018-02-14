<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Operation;
use App\Models\Inventary\OperationDetail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OperationService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'operation';
        $this->model = new Operation();
        $this->namePlural = 'operations';
    }

    public function store(Request $request)
    {
    	try{
         /*   $a = $request->json(['details']);

            for($b; $b<$a;$b++){
                echo 'imprimiendo: '.$a[$b];
            }*/

            echo 'imprimiendo: '.$request->code;
            
            DB::beginTransaction();
            $operation = new Operation();
            $operation->code = $request->code;
            $operation->title = $request->title;
            $operation->description = $request->description;
            $operation->total = $request->total;
            $operation->tax = $request->tax;
            $operation->operation_type = $request->operation_type;
            $operation->client = $request->client;
            $operation->employee = $request->employee;
            $operation->save();

          /*  $products = $request->json(['product']);
            $quantities = $request->json(['quantity']);
            $prices = $request->json(['price']);*/
            $details = $request->details;
            $i = 0;

            while($i < count($details)){
                $detail = new OperationDetail();
                $detail->operation = $operation->id;
                $detail->product = $details[$i]->product;
                $detail->quantity = $details[$i]->quantity;
                $detail->price = $details[$i]->price;
                $detail->save();
                $i++;
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'operation' => $operation
            ],200);

        }catch(\Exception $e){
            DB::rollback();
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(['status'=>false,
                'message'=> 'Error al Intentar Guardar '.$this->name
            ], 500);
        }
    }

    public function update($id, $request)
    {
    	return $this->_update($id, $request);
    }

    public function existsCode($code)
    {
        if(Operation::findByCode($code))
            return true;
         else
            return false;   
    }
	
}