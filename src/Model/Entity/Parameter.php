<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parameter Entity
 *
 * @property int $id
 * @property string $ambient
 * @property float $dollar_promoter_percentage
 * @property float $dollar_father_percentage
 * @property float $dollar_grandfather_percentage
 * @property float $bolivar_promoter_percentage
 * @property float $bolivar_father_percentage
 * @property float $bolivar_grandfather_percentage
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
 * @property string $extra_column11
 * @property string $extra_column12
 * @property string $extra_column13
 * @property string $extra_column14
 * @property string $extra_column15
 * @property string $extra_column16
 * @property string $extra_column17
 * @property string $extra_column18
 * @property string $extra_column19
 * @property string $extra_column20
 * @property string $registration_status
 * @property string $reason_status
 * @property \Cake\I18n\Time $date_status
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Parameter extends Entity
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
