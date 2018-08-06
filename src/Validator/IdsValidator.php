<?php namespace Signal\Validator;

use Signal\Exceptions\CheckStatusValidatorException;

class IdsValidator
{
    /**
     * Validate message Ids;
     *
     * @param array $ids
     * @throws \Signal\Exceptions\CheckStatusValidatorException
     */
    public static function validate($ids)
    {
        if(!$ids || !is_array($ids)) {
            throw new CheckStatusValidatorException('can not check text messages status for empty or none array $ids');
        }

        foreach ($ids as $id) {
            $id = (int) $id;
            if(!$id) {
                throw new CheckStatusValidatorException('can not check text message status for empty or none integer $id');
            }
        }
    }
}