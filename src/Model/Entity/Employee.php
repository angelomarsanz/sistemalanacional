<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $code_for_user
 * @property string $first_name
 * @property string $second_name
 * @property string $surname
 * @property string $second_surname
 * @property string $sex
 * @property string $nationality
 * @property string $type_of_identification
 * @property string $identity_card
 * @property string $rif
 * @property string $profile_photo
 * @property string $profile_photo_dir
 * @property string $place_of_birth
 * @property string $country_of_birth
 * @property \Cake\I18n\Time $birthdate
 * @property string $cell_phone
 * @property string $landline
 * @property string $email
 * @property string $address
 * @property string $degree_instruction
 * @property \Cake\I18n\Time $date_of_admission
 * @property \Cake\I18n\Time $retirement_date
 * @property string $reason_withdrawal
 * @property string $classification
 * @property int $position_id
 * @property string $working_agreement
 * @property int $hours_month
 * @property float $percentage_imposed
 * @property bool $record_deleted
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Position $position
 */
class Employee extends Entity
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
