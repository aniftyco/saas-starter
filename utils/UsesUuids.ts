import { v4 as uuid } from 'uuid';

import { NormalizeConstructor } from '@ioc:Adonis/Core/Helpers';
import { beforeCreate, LucidModel } from '@ioc:Adonis/Lucid/Orm';

export const UsesUuids = <T extends NormalizeConstructor<LucidModel>>(Superclass: T) => {
  class ModelWithUuids extends Superclass {
    @beforeCreate()
    public static async setIdWithUuid(model: any) {
      model.id = uuid();
    }
  }

  return ModelWithUuids;
};
