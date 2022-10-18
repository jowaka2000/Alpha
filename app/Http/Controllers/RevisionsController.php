<?php

namespace App\Http\Controllers;

use App\Actions\Alerts\RevisionSubmitAlert;
use App\Actions\Alerts\RevisionSubmitAlertAction;
use App\Actions\Files\StoreAnswerFileAction;
use App\Actions\Mails\SubmitRevisionMailAction;
use App\Http\Requests\UpdateCompletedRequest;
use App\Jobs\SendAlert;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Completed;
use App\Models\File;
use App\Models\Refund;
use App\Models\Revise;
use Illuminate\Support\Facades\Storage;
use App\Actions\Updates\UpdateCompletedAction;


class RevisionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $completed = Completed::allRevision($search);
        return view('Tasks.revision.index', compact('completed', 'search'));
    }

    public function show(Completed $completed)
    {
        $this->authorize('canSaw', $completed);
        $revision = Revise::where('order_id', $completed->order->id)->first();
        $files = Refund::where('order_id', $completed->order->id)->get();
        $orderFiles = File::where('order_id', $completed->order_id)->get();
        $answers = Answer::where('order_id', $completed->order->id)->get();
        return view('Tasks.revision.show', compact('completed', 'revision', 'files', 'orderFiles', 'answers'));
    }

    public function update(
        UpdateCompletedRequest $request,
        Completed $completed,
        UpdateCompletedAction $updateCompletedAction,
        StoreAnswerFileAction $storeAnswerFileAction,
        RevisionSubmitAlertAction $revisionSubmitAlertAction,
        SubmitRevisionMailAction $submitRevisionMailAction
    ) {
        $this->authorize('update', $completed);

        $updateCompletedAction->execute($request, $completed);

        if ($request->has('answers')) {
            $storeAnswerFileAction->execute($request->file('answers'), $completed->order);
        }

        $revisionSubmitAlertAction->execute($completed, auth()->user());

        $submitRevisionMailAction->execute($completed);


        $refunds = Refund::where('order_id', $completed->order->id)->get();

        foreach ($refunds as $refund) {
            $refund->delete();
        }

        $revise = Revise::where('order_id', $completed->order->id)->first();

        $revise->delete();

        return to_route('revision.index')->with('revision_message', 'Responce for revision has been sent succesfuly!');
    }

    public function downloadAnswers(Answer $answer)
    {
        if (!Storage::exists('answers/' . $answer->file_name)) {
            return;
        }
        return Storage::download('answers/' . $answer->file_name, $answer->file_original_name);
    }
}
