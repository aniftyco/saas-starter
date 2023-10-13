import { DateTime } from 'luxon';

import Session from '@app/Models/Session';
import { SoftDeletes } from '@ioc:Adonis/Addons/LucidSoftDeletes';
import Hash from '@ioc:Adonis/Core/Hash';
import { compose } from '@ioc:Adonis/Core/Helpers';
import { BaseModel, beforeSave, column, HasMany, hasMany } from '@ioc:Adonis/Lucid/Orm';
import { UsesUuids } from '@ioc:Kubit/Support';

export default class User extends compose(BaseModel, SoftDeletes, UsesUuids) {
  @column({ isPrimary: true })
  public id: string;

  @column()
  public email: string;

  @column()
  public password: string;

  @column()
  public rememberMeToken: string | null;

  @column()
  public name: string;

  @column.dateTime()
  public confirmedAt: DateTime | null;

  @column.dateTime({ autoCreate: true })
  public createdAt: DateTime;

  @column.dateTime({ autoCreate: true, autoUpdate: true })
  public updatedAt: DateTime;

  @hasMany(() => Session)
  public sessions: HasMany<typeof Session>;

  @beforeSave()
  public static async hashPassword(user: User) {
    if (user.$dirty.password) {
      user.password = await Hash.make(user.password);
    }
  }
}
