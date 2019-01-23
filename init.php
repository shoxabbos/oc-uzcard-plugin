<?php
use RainLab\User\Models\User as UserModel;

Event::listen('shohabbos.uzcard.successPayment', function ($transaction, &$message) {
    // add balance or check order as paid
	$user = UserModel::find($transaction->owner_id);
	$user->balance += $transaction->amount;
	$user->save();
});