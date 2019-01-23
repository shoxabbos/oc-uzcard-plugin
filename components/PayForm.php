<?php namespace Shohabbos\Uzcard\Components;

use Input;
use Event;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Shohabbos\Uzcard\Classes\Helper;
use Shohabbos\Uzcard\Models\Settings;
use Shohabbos\Uzcard\Models\Transaction;

/**
 * User session
 *
 * This will inject the user object to every page and provide the ability for
 * the user to sign out. This can also be used to restrict access to pages.
 */
class PayForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Pay form',
            'description' => 'Выводит на страницу форму для оплаты'
        ];
    }

    public function defineProperties()
    {
        return [
            'paramAmount' => [
                'title'       => 'shohabbos.payeer::lang.payform.amount_param',
                'description' => 'shohabbos.payeer::lang.payform.amount_param_desc',
                'type'        => 'string',
                'default'     => 'amount'
            ],
            'paramOrder' => [
                'title'       => 'shohabbos.payeer::lang.payform.order_param',
                'description' => 'shohabbos.payeer::lang.payform.order_param_desc',
                'type'        => 'string',
                'default'     => 'order_id'
            ],
        ];
    }

    public function onPay() {
        $data = Input::only(['code', 'transaction']);

        $validator = Validator::make($data, [
            'code' => 'required',
            'transaction' => 'required|exists:shohabbos_uzcard_transactions,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $transaction = Transaction::find($data['transaction']);

        $uzcardData = [
            'phoneNumber' => $transaction->phone,
            'cardLastNum' => $transaction->card,
            'expire' => $transaction->expire,
            'summa' => $transaction->amount,
            'uniques' => $transaction->uniques,
            'otp' => $data['code'],
            'key' => Settings::get('key'),
            'eposId' => Settings::get('epos_id'),
        ];

        $result = json_decode(Helper::send($uzcardData), true);

        if (isset($result['error'])) {
            throw new ValidationException(['message' => $result['error']['message']]);
        }

        $transaction->success = true;
        $transaction->trans_id = $result['result']['transacID'];
        $transaction->save();

        $message = "To'lov amalga oshirildi.";
        Event::fire('shohabbos.uzcard.successPayment', [$transaction, &$message]);

        \Flash::success($message);
    }



    public function onGetPaymentCode()
    {
        $data = Input::only(['phone', 'card', 'expire', 'amount', 'owner_id']);

        $validator = Validator::make($data, [
            'phone' => 'required|regex:/^998[0-9]{9}$/',
            'card' => 'required|regex:/^[0-9]{6}$/',
            'expire' => 'required|regex:/^[0-9]{4}$/',
            'amount' => 'required|numeric|min:1',
            'owner_id' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $uzcardData = [
            'phoneNumber' => $data['phone'],
            'cardLastNum' => $data['card'],
            'expire' => $data['expire'],
            'summa' => $data['amount'],

            // from settings admin panel
            'key' => Settings::get('key'),
            'eposId' => Settings::get('epos_id'),
        ];


        $result = json_decode(Helper::send($uzcardData), true);

        if (isset($result['error'])) {
            throw new ValidationException(['message' => $result['error']['message']]);
        }

        $data['uniques'] = $result['result']['uniques'];
        $transaction = Transaction::create($data);

        $this->page['transaction'] = $transaction;

        \Flash::success('Telefon raqamingizga tasdiqlash kodi yuborildi');
    }


    
}
