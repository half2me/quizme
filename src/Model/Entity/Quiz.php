<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Quiz Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $name
 * @property \App\Model\Entity\AttributeType[] $attribute_types
 * @property \App\Model\Entity\Data[] $data
 * @property \App\Model\Entity\SharedUser[] $shared_users
 */
class Quiz extends Entity
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
        'id' => false,
    ];
}
