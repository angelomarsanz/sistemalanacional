<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Iteme Entity
 *
 * @property int $id
 * @property int $budget_id
 * @property string $itemes
 * @property string $registration_status
 * @property string $reason_status
 * @property \Cake\I18n\Time $date_status
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Budget $budget
 */
class Iteme extends Entity
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
