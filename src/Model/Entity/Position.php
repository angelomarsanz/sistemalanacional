<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Position Entity
 *
 * @property int $id
 * @property string $position
 * @property string $type_of_salary
 * @property float $minimum_wage
 * @property string $reason_salary_increase
 * @property \Cake\I18n\Time $effective_date_increase
 * @property bool $record_deleted
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Employee[] $employees
 */
class Position extends Entity
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
