import Schema from '@ioc:Adonis/Lucid/Schema';

export default class CreatUuidExtension extends Schema {
  public async up() {
    this.defer(() => this.schema.raw('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"'));
  }

  public async down() {
    this.defer(() => this.schema.raw('DROP EXTENSION IF EXISTS "uuid-ossp"'));
  }
}
