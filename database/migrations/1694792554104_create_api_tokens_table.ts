import Schema from '@ioc:Adonis/Lucid/Schema';

export default class CreateApiTokensTable extends Schema {
  protected tableName = 'api_tokens';

  public async up() {
    this.schema.createTable(this.tableName, (table) => {
      table.uuid('id').primary().defaultTo(this.raw('uuid_generate_v4()'));
      table.uuid('user_id').references('id').inTable('users');
      table.string('name').notNullable();
      table.string('type').notNullable();
      table.string('token').notNullable().unique();

      table.timestamp('expires_at', { useTz: true }).nullable();

      table.timestamp('created_at', { useTz: true }).notNullable().defaultTo(this.raw('NOW()'));
      table.timestamp('updated_at', { useTz: true }).notNullable().defaultTo(this.raw('NOW()'));
      table.timestamp('deleted_at', { useTz: true }).nullable();
    });
  }

  public async down() {
    this.schema.dropTable(this.tableName);
  }
}