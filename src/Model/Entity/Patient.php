<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $supervisor_id
 * @property int $promoter_id
 * @property int $vendor_id
 * @property string $another_half_capture
 * @property string $first_name
 * @property string $second_name
 * @property string $surname
 * @property string $second_surname
 * @property string $sex
 * @property \Cake\I18n\Time $birthdate
 * @property string $type_of_identification
 * @property string $identidy_card
 * @property string $profession
 * @property string $item
 * @property string $item_not_specified
 * @property string $work_phone
 * @property string $workplace
 * @property string $professional_position
 * @property string $work_address
 * @property string $cell_phone
 * @property string $landline
 * @property string $email
 * @property string $address
 * @property string $bank
 * @property string $bank_address
 * @property string $swift_bank
 * @property string $aba_bank
 * @property string $first_name_emergency
 * @property string $second_name_emergency
 * @property string $surname_emergency
 * @property string $second_surname_emergency
 * @property string $type_of_identification_emergency
 * @property string $identidy_card_emergency
 * @property string $address_emergency
 * @property string $email_emergency
 * @property string $landline_emergency
 * @property string $cell_phone_emergency
 * @property string $first_name_companion
 * @property string $second_name_companion
 * @property string $surname_companion
 * @property string $second_surname_companion
 * @property string $type_of_identification_companion
 * @property string $identidy_card_companion
 * @property string $address_companion
 * @property string $email_companion
 * @property string $landline_companion
 * @property string $cell_phone_companion
 * @property bool $payment_own_resources
 * @property string $sponsor
 * @property string $sponsor_type
 * @property string $sponsor_identification
 * @property string $address_sponsor
 * @property string $email_sponsor
 * @property string $landline_sponsor
 * @property string $cell_phone_sponsor
 * @property string $status_diary_patient
 * @property string $status_history_patient
 * @property string $responsible_user
 * @property bool $record_delete
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Supervisor $supervisor
 * @property \App\Model\Entity\Promoter $promoter
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Diarypatient[] $diarypatients
 * @property \App\Model\Entity\Historypatient[] $historypatients
 * @property \App\Model\Entity\Servicescontract[] $servicescontracts
 */
class Patient extends Entity
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
    
    protected function _getFullName()
    {
        return $this->_properties['first_name'] . ' ' .
            $this->_properties['second_name'] . ' ' .
            $this->_properties['surname'] . ' ' .
            $this->_properties['second_surname'];
    }    

}
