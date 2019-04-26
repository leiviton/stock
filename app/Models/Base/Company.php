<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 16 Apr 2019 20:09:26 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 *
 * @property int $id
 * @property string $cnpj
 * @property string $nome
 * @property string $logo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class Company extends Eloquent
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(\Stock\Models\User::class);
    }

    /**
     * @return mixed
     */
    public function outs()
    {
        return $this->hasMany(\Stock\Models\Out::class,'depositante','cnpj');
    }

    /**
     * @return mixed
     */
    public function roads()
    {
        return $this->hasMany(\Stock\Models\Road::class,'depositante','cnpj');
    }

    /**
     * @return mixed
     */
    public function stocks()
    {
        return $this->hasMany(\Stock\Models\Stock::class,'cnpj_origem','cnpj');
    }

    /**
     * Get the relationships for the entity.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
