import { DateTime } from 'luxon';

import User from '@app/Models/User';
import { SoftDeletes } from '@ioc:Adonis/Addons/LucidSoftDeletes';
import { compose } from '@ioc:Adonis/Core/Helpers';
import { BaseModel, BelongsTo, belongsTo, column } from '@ioc:Adonis/Lucid/Orm';

export default class Session extends compose(BaseModel, SoftDeletes) {
  @column({ isPrimary: true })
  public id: string;

  @column()
  public userId: string;

  @column()
  public ip: string;

  @column()
  public agent: string;

  @column.dateTime({ autoCreate: true })
  public createdAt: DateTime;

  @column.dateTime({ autoCreate: true, autoUpdate: true })
  public updatedAt: DateTime;

  @belongsTo(() => User)
  public user: BelongsTo<typeof User>;
}
