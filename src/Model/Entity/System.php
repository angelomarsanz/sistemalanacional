<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * System Entity
 *
 * @property int $id
 * @property string $clinical_name
 * @property string $identification
 * @property string $fiscal_address
 * @property string $tax_phone
 * @property string $logo
 * @property bool $headline_switch
 * @property bool $administrator_switch
 * @property bool $supervisor_switch
 * @property bool $promoter_switch
 * @property bool $vendor_switch
 * @property bool $patient_switch
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class System extends Entity
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
