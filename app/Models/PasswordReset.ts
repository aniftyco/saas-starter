import { DateTime } from 'luxon';

import User from '@app/Models/User';
import { compose } from '@ioc:Adonis/Core/Helpers';
import { BaseModel, BelongsTo, belongsTo, column } from '@ioc:Adonis/Lucid/Orm';
import { UsesUuids } from '@utils/UsesUuids';

export default class PasswordReset extends compose(BaseModel, UsesUuids) {
  @column({ isPrimary: true })
  public id: string;

  @column()
  public userId: string;

  @column()
  public token: string;

  @column.dateTime({ autoCreate: true })
  public createdAt: DateTime;

  @belongsTo(() => User)
  public user: BelongsTo<typeof User>;
}
