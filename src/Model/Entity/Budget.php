<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Budget Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property \Cake\I18n\Time $application date
 * @property string $surgery
 * @property \Cake\I18n\Time $activity_date_finish
 * @property string $activity_result
 * @property string $detailed_result_activity
 * @property string $responsible_user
 * @property bool $deleted_record
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Diarypatient[] $diarypatients
 * @property \App\Model\Entity\Patienthistory[] $patienthistories
 */
class Budget extends Entity
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
