<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity
 *
 * @property int $id
 * @property string $service_code
 * @property string $service_description
 * @property string $full_service_description
 * @property float $cost_bolivars
 * @property float $cost_dollars
 * @property string $registration_status
 * @property string $reason_status
 * @property \Cake\I18n\Time $date_status
 * @property string $responsible_user
 * @property \Cake\I18n\Time $created
 * @property float $modified
 *
 * @property \App\Model\Entity\Hiredservice[] $hiredservices
 */
class Service extends Entity
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
