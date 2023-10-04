import { DateTime } from 'luxon';

import User from '@app/Models/User';
import Env from '@ioc:Adonis/Core/Env';
import Seed from '@ioc:Adonis/Lucid/Seeder';

export default class UserSeed extends Seed {
  public async run() {
    await User.create({
      email: Env.get('DATABASE_SEED_EMAIL', 'jane.doe@example.com'),
      password: Env.get('DATABASE_SEED_PASSWORD', 'hunter2'),

      name: Env.get('DATABASE_SEED_NAME', 'Jane Doe'),
    });
  }
}
