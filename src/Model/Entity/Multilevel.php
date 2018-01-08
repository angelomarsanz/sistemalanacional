<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Multilevel Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $father
 * @property string $first_name
 * @property string $second_name
 * @property string $surname
 * @property string $second_surname
 * @property string $sex
 * @property \Cake\I18n\Time $birthdate
 * @property string $type_of_identification
 * @property string $identidy_card
 * @property string $profession
 * @property string $cell_phone
 * @property string $landline
 * @property string $email
 * @property string $country
 * @property string $province_state
 * @property string $city
 * @property string $address
 * @property bool $active
 * @property \Cake\I18n\Time $deactivation_date
 * @property string $account_number
 * @property string $bank
 * @property string $bank_address
 * @property string $swift_bank
 * @property string $aba_bank
 * @property string $responsible_user
 * @property bool $delete_record
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Multilevel extends Entity
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
