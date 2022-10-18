<?php

use App\Actions\Mails\UnsubscribeUnocksUserMailAction;
use App\Actions\Others\RefferalEarningsForSubscriptionAction;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\OrdersLivewire;
use App\Http\Livewire\MyOrdersLivewire;
use App\Http\Livewire\AsignedLivewire;
use App\Http\Livewire\CompletedLivewire;
use App\Http\Livewire\NotificationsLivewire;
use App\Http\Livewire\ClientsLivewire;
use App\Http\Livewire\WritersLivewire;
use App\Http\Livewire\InvitedLivewire;
use App\Http\Livewire\CanceledOrdersLivewire;
use App\Http\Livewire\BidsLivewire;
use App\Http\Livewire\RejectedBidsLivewire;
use App\Http\Livewire\MyWritersLivewire;
use App\Http\Livewire\BlockedWritersLivewire;
use App\Http\Livewire\BlockedClientsLivewire;
use App\Http\Livewire\MyClientsLivewire;

use Illuminate\Support\Facades\Crypt;

use App\Http\Controllers\ViewOrderController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\AssignedController;
use App\Http\Controllers\CompletedsController;
use App\Http\Controllers\RejectedsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\InvokesController;
use App\Http\Controllers\TrushsController;
use App\Http\Controllers\ConfirmsNumberController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RevisionsController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\UnlocksController;
use App\Http\Controllers\UnlocksPaymentsController;
use App\Http\Controllers\WriterProfileController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\HelpCentersController;
use App\Http\Controllers\Payments\MpesaController;
use App\Http\Controllers\Payments\PaypalPaymentsController;
use App\Http\Controllers\Payments\TransactionRecordsController;
use App\Http\Controllers\Subscriptions\OrdersSubscriptionController;
use App\Http\Controllers\Subscriptions\UnlocksSubscriptionsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\Unlocks\CompletedUnlocksController;
use App\Http\Controllers\Unlocks\DraftUnlocksController;
use App\Http\Controllers\Unlocks\ReportUnlocksController;
use App\Http\Controllers\Unlocks\UnlockRefundsController;
use App\Http\Controllers\Unlocks\UnlocksPayController;
use App\Http\Controllers\User\ReportsController;
use App\Jobs\OrdersSubsctriptionEndMailJob;
use App\Mail\SubscriptionEndMail;
use App\Mail\Subscriptions\UnlocksSubscriptionFailMail;
use App\Mail\Subscriptions\UnlockSSubscriptionPlanExpiaryMail;
use App\Mail\UnlockSubscriptionMail;
use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

Route::controller(GuestsController::class)->group(function () {
    Route::get('/', 'index')->name('guest');
    Route::get('register-as', 'registerAs')->name('register-as');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'store');
    Route::get('logout', 'logout')->name('logout');
});
Route::controller(RegistersController::class)->group(function () {
    Route::get('register-client', 'registerClient')->name('register.client');
    Route::post('register-client', 'storeClient');
    Route::get('register-writer', 'registerWriter')->name('register.writer');
    Route::post('register-writer', 'storeWriter');
});


Route::controller(OrdersController::class)->group(function () {
    Route::get('orders/my-orders', 'index')->name('orders.index');
    Route::get('orders/all-orders', 'allOrders')->name('orders.all');
    Route::get('orders/invited', 'invitedOrders')->name('orders.invited');
    Route::get('orders/{order}/my-orders', 'show')->name('orders.show-my-writers');
    Route::get('orders/{order}/all-orders', 'allWriters')->name('orders.show-all-writers');
    Route::get('orders/{order}/shortlisted-orders', 'shortlistedWriters')->name('orders.show-shortlisted-writers');
    Route::get('orders/{order}/view', 'viewDetails')->name('orders.view');
    Route::get('orders/{order}/edit', 'edit')->name('orders.edit');
    Route::post('orders/{order}/edit', 'update');
    Route::get('orders/create', 'create')->name('orders.create');
    Route::post('orders/create', 'store');
    Route::delete('orders/{order}/my-orders', 'destroy')->name('orders.destroy');
    Route::get('orders/{file}', 'download')->name('file.download');
    Route::delete('delete/{file}', 'deleteFile')->name('delete.file');
});
Route::controller(BidsController::class)->group(function () {
    Route::get('my-bids', 'index')->name('bids.index');
    //bids for writers
    Route::post('bids/{order}', 'store')->name('bids.create');
    Route::post('accept/{bid}', 'acceptBid')->name('bids.accept');
    Route::post('bid/{bid}', 'addToShortlist')->name('bids.add-to-shortlist');
    Route::post('remove/{bid}', 'removeFromShortlisted')->name('remove.shortlisted');
});



Route::controller(AssignedController::class)->group(function () {
    Route::get('assigned', 'index')->name('assigned.index');
    Route::get('assigned/{assigned}', 'show')->name('assigned.show');
    Route::post('assigned/{assigned}', 'reAssignOrder');
    Route::get('assigned/{order}/edit', 'edit')->name('assigned.edit');
    Route::get('assigned/{assigned}/submit-answers', 'submit')->name('assigned.submit');
    Route::post('assigned/{assigned}/submit-answers', 'storeAnswers');
});
Route::controller(CompletedsController::class)->group(function () {
    Route::get('completed/pending', 'index')->name('completed.index');
    Route::get('completed/approved', 'approved')->name('completed.aproved');
    Route::get('order-completed/{order}/edit', 'edit')->name('completed.edit');
    Route::post('order-completed/{order}/edit', 'updateOrder');
    Route::get('completed/{completed}/show', 'show')->name('completed.show');
    Route::post('completed/{completed}/show', 'update');
    Route::get('completed/{completed}/refund', 'refund')->name('completed.refund');
    Route::post('completed/{completed}/refund', 'store');
    Route::post('completed/{completed}/edit', 'update');
    Route::get('completed/{answer}', 'download')->name('answer.download');
    Route::post('approve/{completed}', 'approve')->name('approve');
    Route::post('completed/{completed}', 'reject')->name('reject');
});




Route::controller(RevisionsController::class)->group(function () {
    Route::get('revision', 'index')->name('revision.index');
    Route::get('revision/show/{completed}', 'show')->name('revision.show');
    Route::post('revision/show/{completed}', 'update');
    Route::get('revision/{answer}', 'downloadAnswers')->name('revision.download'); //
});



Route::controller(RejectedsController::class)->group(function () {
    Route::get('rejected', 'index')->name('rejected.index');
    Route::get('rejected/{rejected}', 'show')->name('rejected.show');
});
Route::controller(UsersController::class)->group(function () {
    Route::get('writers/home', 'writers')->name('users.writers');
    Route::get('writers/my-writers', 'myWriters')->name('users.my-writers');
    Route::get('clients', 'clients')->name('users.clients');
});

Route::get('email-test', function () {
});

Route::controller(WriterProfileController::class)->group(function () {
    Route::get('writer-profile/{user}', 'index')->name('writer-profile');
    Route::get('writer-profile/{user}/edit', 'edit')->name('writer-profile.edit');
    Route::post('writer-profile/{user}/edit', 'store');
    Route::get('writer-profile/{user}/edit-bio', 'editBio')->name('writer-profile.edit-bio');
    Route::post('writer-profile/{user}/edit-bio', 'storeBio');
    Route::post('remove-employer/{employer}', 'destroy')->name('remove-employer');
    Route::get('sample-download/{bioFile}', 'sampleDownload')->name('sample-download');
    Route::get('cv-download/{bio}', 'cvDownload')->name('cv-download');
});


Route::controller(EmployerProfileController::class)->group(function () {
    Route::get('employer-profile/{user}', 'index')->name('employer-profile');
    Route::get('employer-profile/{user}/edit', 'edit')->name('employer-profile.edit');
    Route::post('employer-profile/{user}/edit', 'store');
    Route::get('employer-profile/{user}/edit-bio', 'editBio')->name('employer-profile.edit-bio');
    Route::post('employer-profile/{user}/edit-bio', 'storeBio');
});

Route::controller(ProfilesController::class)->group(function () {
    Route::get('something')->name('my-profile');
    Route::get('store', 'store');
});

Route::controller(InvitationsController::class)->group(function () {
    Route::get('invitation', 'index')->name('invitation');
    Route::post('ivitation/{invite}', 'accept')->name('invitation.accept');
    Route::delete('invite/{invite}', 'cancel')->name('cancel');
});
Route::controller(InvokesController::class)->group(function () {
    Route::get('invoked', 'index')->name('invoked');
    Route::post('invoked/{invoke}', 'invoke')->name('invoked.invoke');
    Route::delete('invoke/{invoke}', 'remove')->name('remove');
});

Route::controller(ReportsController::class)->group(function () {
    Route::get('report/{user}', 'index')->name('report.index');
    Route::post('report/{user}', 'store');
});

Route::controller(TrushsController::class)->group(function () {
    Route::get('trash', 'index')->name('trash');
    Route::post('trash/{id}', 'restore')->name('trash.restore');
    Route::delete('trashed/{id}', 'delete')->name('delete');
});


Route::controller(OrdersSubscriptionController::class)->group(function () {
    Route::get('orders-subscription', 'index')->name('orders-subscription.index');
    Route::get('orders-subscription/mpesa/{plan}', 'mpesa')->name('orders-subscription.mpesa');
    Route::post('orders-subscription/mpesa/{plan}', 'mpesaStore');
    Route::get('orders-subscription/paypal/{plan}', 'paypal')->name('orders-subscription.paypal');
    Route::post('orders-subscription/paypal/{plan}', 'paypalStore');
    Route::get('orders-subscription/wait/{plan}', 'wait')->name('orders-subscription.wait');
    Route::get('orders-subscription/pay-from-wallet/{plan}', 'payFromWallet')->name('orders-subscription.pay-from-wallet');
    Route::post('orders-subscription/pay-from-wallet/{plan}', 'payFromWalletStore');
});

Route::controller(UnlocksSubscriptionsController::class)->group(function () {
    Route::get('unlocks-subscription', 'index')->name('unlocks-subscriprion.index');
    Route::get('unlocks-subscription/mpesa/{plan}', 'mpesa')->name('unlocks-subsription.mpesa');
    Route::post('unlocks-subscription/mpesa/{plan}', 'mpesaStore');
    Route::get('unlocks-subscription/paypal/{plan}', 'paypal')->name('unlocks-subsription.paypal');
    Route::get('unlocks-subscription/pay-from-wallet/{plan}', 'payFromWallet')->name('unlocks-subscription.pay-from-wallet');
    Route::post('unlocks-subscription/pay-from-wallet/{plan}', 'payFromWalletStore');
    Route::get('unlocks-subscription/{pan}/wait', 'wait')->name('unlocks-subscription-wait');
});


Route::controller(ConfirmsNumberController::class)->group(function () {
    Route::get('confirm-number', 'index')->name('confim-number');
    Route::post('confirm-number', 'store');
    Route::get('confirm-number/waiting', 'wait')->name('confim-number-waiting');
});
Route::controller(EarningsController::class)->group(function () {
    Route::get('earnings', 'index')->name('earnings.index');
    Route::get('earnings/{order}', 'order')->name('earnings.order');
});
Route::controller(PaymentsController::class)->group(function () {
    Route::get('payments', 'index')->name('payments.index');
    Route::get('payments/{writer}', 'writer')->name('payments.show');
    Route::get('payments/{writer}/{order}', 'order')->name('payments.order-view');
    Route::get('payment/{writer}/pay', 'payOneWriter')->name('payments.pay-one-writer');
    Route::post('payment/{writer}/pay', 'payOneWriterStore');
    Route::get('paying/{order}/pay', 'payOneOrder')->name('payments.pay-one-order');
    Route::post('paying/{order}/pay', 'payOneOrderStore');
});

Route::controller(TransactionRecordsController::class)->group(function () {
    Route::get('transaction-records', 'index')->name('transaction-records.index');
});

Route::controller(NotificationsController::class)->group(function () {
    Route::get('notifications', 'index')->name('notification');
    Route::post('notifications', 'markAllAsRead');
});

Route::controller(TransactionsController::class)->group(function () {
    Route::get('deposit/mpesa/{user}', 'mpesaDeposit')->name('deposit.mpesa');
    Route::post('deposit/mpesa/{user}', 'mpesaStore');
    Route::get('deposit/mpesa/{user}/wait', 'mpesaWait')->name('depost.mpesa.wait');
    Route::get('deposit/paypal/{user}', 'paypalDeposit')->name('deposit.paypal');
    Route::post('deposit/paypal/{user}', 'paypalStore');

    Route::get('withdraw/mpesa/{user}', 'mpesaWithdraw')->name('withdraw.mpesa');
    Route::post('withdraw/mpesa/{user}', 'mpesaWithdrawStore');
    // Route::get('deposit/mpesa/{user}/wait','mpesaWait')->name('withdraw.mpesa.wait');
    Route::get('withdraw/paypal/{user}', 'paypalWithdraw')->name('withdraw.paypal');
    Route::post('withdraw/paypal/{user}', 'paypalWithdrawStore');
});

Route::controller(UnlocksPayController::class)->group(function () {
    Route::get('unlocks-pay/mpesa/{unlock}', 'mpesa')->name('unlock-pay.mpesa');
    Route::post('unlocks-pay/{unlock}', 'storeMpesa');
    Route::get('unlocks-pay/paypal/mpesa/{unlock}', 'paypal')->name('unlock-pay.paypal');
    Route::post('unlocks-pay/paypal/{unlock}', 'storePaypal');
    Route::get('unlock-pay-from-wallet/{unlock}', 'payFromWallet')->name('unlock-pay-wallet');
});

Route::controller(ReportUnlocksController::class)->group(function () {
    Route::get('report-unlocks/{unlock}', 'index')->name('report-unlocks');
    Route::post('report-unlocks/{unlock}', 'store');
});

Route::get('unlock-draft', [DraftUnlocksController::class, 'index'])->name('unlocks-draft');

Route::controller(CompletedUnlocksController::class)->group(function () {
    route::get('unlocks-completed', 'index')->name('unlocks-completed.index');
    route::get('unlocks-completed/{unlock}', 'show')->name('unlocks-completed.show');
});

Route::controller(UnlockRefundsController::class)->group(function () {
    Route::get('unlock-refunds', 'index')->name('unlock-refund.index');
    Route::get('unlock-refunds/{unlock}', 'show')->name('unlock-refund.show');
    Route::get('unlock-refunds/{unlock}/create', 'create')->name('unlock-refund.create');
    Route::post('unlock-refunds/{unlock}/create', 'store');
    Route::get('unlock-refunds/{unlock}/edit', 'edit')->name('unlock-refund.edit');
    Route::post('unlock-refunds/{unlock}/edit', 'update');
});

Route::controller(UnlocksController::class)->group(function () {
    Route::get('unlocks/all', 'index')->name('unlocks.index');
    Route::post('take/{unlock}', 'take')->name('take');
    Route::get('unlocks/{unlock}/edit', 'edit')->name('unlocks.edit');
    Route::post('unlocks/{unlock}/edit', 'update');
    Route::delete('unlocks/{unlock}/edit', 'destroy')->name('unlock.delete');
    Route::delete('file/{unlockFile}/destroy', 'fileDestroy')->name('unlock-file-delete');
    Route::get('unlocks/in-progress', 'inProgress')->name('unlocks.in-progress');
    Route::get('unlocks/completed/{unlock}', 'completedUpdate')->name('unlocks.completed.update');
    Route::post('unlocks/completed/{unlock}', 'completedUpateStore');
    Route::delete('unlocks/completed/{UnlockAnswersFile}', 'completedFileDestroy');
    Route::get('unlocks/create', 'create')->name('unlocks.create');
    Route::post('unlocks/create', 'store');
    Route::get('unlocks/submit-unlock/{unlock}', 'submitUnlock')->name('unlocks.submit-unlock');
    Route::post('unlocks/submit-unlock/{unlock}', 'storeAnswers');
    Route::get('download/{unlockFile}', 'download')->name('unlock-download-file');
    Route::get('answers/{answers}', 'downloadAnswers')->name('answers-download-file');
});

Route::get('withdraw/unlocks/earnings/{user}', [UnlocksPaymentsController::class, 'index'])->name('withdraw.unlocks.payments');


Route::controller(RewardsController::class)->group(function () {
    Route::get('rewards', 'index')->name('reward.index');
    Route::get('rewards/learn', 'learn')->name('reward.learn');
});

Route::controller(Adminscontroller::class)->group(function () {
});

Route::controller(HelpCentersController::class)->group(function () {
    Route::get('help-center/{user}', 'index')->name('helpcenter.index');
    Route::post('help-center/{user}', 'store');
});


Route::get('handle-payment', [PaypalPaymentsController::class, 'handlePayment']);
Route::get('cancel-payment', [PaypalPaymentsController::class, 'cancelPayment']);
Route::get('payment-success', [PaypalPaymentsController::class, 'successPayment']);


Route::get('test-test-email', function (RefferalEarningsForSubscriptionAction $un) {


    // $access = Access::find(1);

    // // dd((now()->tz('Africa/Addis_Ababa'))->format('d:M:Y h:i:s'),now()->format('d:M:Y h:i:s'));
    // dd(((now()->addMinutes(3))->tz('Africa/Addis_Ababa'))->format('d:M:Y h:i:s'),(now()->tz('Africa/Addis_Ababa'))->format('d:M:Y h:i:s')>(new Carbon($access->unlocks_subscription_end))->format('d:M:Y h:i:s'));

    $access = Access::find(1);

    $user = User::find(1);

    $re = $un->execute(1, $user, 'unlocks');

    dd($re);
    return 'lsakd';
});
Route::get('index', [MpesaController::class, 'index']);
Route::get('access-token', [MpesaController::class, 'generateAccessToken']);
//.Route::get('my-orders',MyOrdersLivewire::class)->name('my-orders');
//Route::get('invited-orders', InvitedLivewire::class)->name('invited-orders');
//Route::get('assigned',asignedLivewire::class)->name('assigned');
//Route::get('canceled', CanceledOrdersLivewire::class)->name('canceled');
//Route::get('completed',CompletedLivewire::class)->name('completed');
//Route::get('rejected-bids',RejectedBidsLivewire::class)->name('rejected-bids');

//Route::get('bids',BidsLivewire::class)->name('bids');


//Route::get('notification',NotificationsLivewire::class)->name('notification');
//Route::get('clients',ClientsLivewire::class)->name('clients');
//Route::get('my-clients',MyClientsLivewire::class)->name('my-clients');
//Route::get('blocked-clients', BlockedClientsLivewire::class)->name('blocked-clients');
//Route::get('writers',WritersLivewire::class)->name('writers');
//Route::get('my-writers', MyWritersLivewire::class)->name('my-writers');
//Route::get('blocked-writers', BlockedWritersLivewire::class)->name('blocked-writers');

//Route::get('orders/{order}',[ViewOrderController::class,'show'])->name('orders-view');
