<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Commission Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $budget_id
 * @property string $type_beneficiary
 * @property float $amount
 * @property string $coin
 * @property string $payment_method
 * @property string $bank
 * @property string $account
 * @property string $reference
 * @property \Cake\I18n\Time $pay_day
 * @property string $voucher
 * @property string $voucher_dir
 * @property string $extra_column1
 * @property string $extra_column2
 * @property string $extra_column3
 * @property string $extra_column4
 * @property string $extra_column5
 * @property string $extra_column6
 * @property string $extra_column7
 * @property string $extra_column8
 * @property string $extra_column9
 * @property string $extra_column10
 * @property string $registration_status
 * @property string $reason_status
 * @property \Cake\I18n\Time $date_status
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Budget $budget
 */
class Commission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}