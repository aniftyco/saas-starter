import { DateTime } from 'luxon';

import { SoftDeletes } from '@ioc:Adonis/Addons/LucidSoftDeletes';
import Hash from '@ioc:Adonis/Core/Hash';
import { compose } from '@ioc:Adonis/Core/Helpers';
import { BaseModel as Model, beforeSave, column } from '@ioc:Adonis/Lucid/Orm';

export default class User extends compose(Model, SoftDeletes) {
  @column({ isPrimary: true })
  public id: string;

  @column()
  public email: string;

  @column()
  public password: string;

  @column()
  public rememberMeToken: string | null;

  @column()
  public name: string | null;

  @column.dateTime()
  public confirmedAt: DateTime | null;

  @column.dateTime({ autoCreate: true })
  public createdAt: DateTime;

  @column.dateTime({ autoCreate: true, autoUpdate: true })
  public updatedAt: DateTime;

  @column.dateTime()
  public deletedAt: DateTime;

  @beforeSave()
  public static async hashPassword(user: User) {
    if (user.$dirty.password) {
      user.password = await Hash.make(user.password);
    }
  }
}
