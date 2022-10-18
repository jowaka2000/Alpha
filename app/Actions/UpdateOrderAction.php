<?php

namespace App\Actions;

use App\Models\Order;
use Illuminate\Http\Request;

class UpdateOrderAction
{
    public function execute(Request $request, Order $order)
    {

        $oldData = $order->old_data;

        $oldData = json_decode($oldData, true);

        if ($oldData===null) {
            $oldData = $order->toArray();
        } else {
          array_push($oldData, $order->toArray);
        }

        $old_data = json_encode($oldData);

        $order->update([
            'assignment_type' => $request->assignment_type,
            'subject' => $request->subject,
            'service' => $request->service,
            'pages' => $request->pages,
            'words' => $request->words,
            'spacing' => $request->spacing,
            'sources' => $request->sources,
            'citation' => $request->citation,
            'deadline' => $request->deadline,
            'language' => $request->language,
            'topic' => $request->topic,
            'description' => $request->description,
            'price' => $request->price,
            'order_visibility' => $request->order_visibility,
            'old_data' => $old_data,
        ]);
    }
}
