<?php

if (!function_exists('return_data_status')) {

    /**
     * @param string $type
     * @param array|null $data
     * @param int $status
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    function return_data_status(string $type, $data = null, int $status, string $message = null)
    {
        try{
            return response()->json(['type' => $type, 'data' => $data, 'status' => $status, 'message' => $message], 200);
        }catch (\Exception $e){
            return response()->json(['type' => $type, 'status' => $status, 'message' => $message], 200);
        }
    }
}
