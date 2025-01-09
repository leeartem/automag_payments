<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class TransactionCheckForm extends Component
{
    public $message = 'Нажмите кнопку проверки чтобы начать проверку.';
    public $amount = null;

    public $isChecking = false;

    public $transaction = null;


    public function render()
    {
        return view('livewire.transaction-check-form');
    }

    public function poll()
    {
        /** @var Transaction transaction */
        $this->transaction = Transaction::findByAmount((float)$this->amount);
        if ($this->transaction) {
            $this->isChecking = false;
            $this->message = 'Платеж успешен!';
            $this->amount = null;
        }
    }

    public function checkTransaction()
    {
        if ($this->amount < 1) {
            return;
        }

        $this->isChecking = true;
        $this->message = 'Идет проверка платежа';
        $this->transaction = null;
    }
}
