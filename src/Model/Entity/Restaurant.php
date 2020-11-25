<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Restaurant Entity
 *
 * @property int $id
 * @property int $topic_id
 * @property string $code
 * @property string $nom
 *
 * @property \App\Model\Entity\Topic $topic
 * @property \App\Model\Entity\Category[] $categories
 */
class Restaurant extends Entity
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
        'topic_id' => true,
        'code' => true,
        'nom' => true,
        'topic' => true,
        'categories' => true,
    ];
}
