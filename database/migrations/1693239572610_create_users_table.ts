import Schema from '@ioc:Adonis/Lucid/Schema';

export default class CreateUsersTable extends Schema {
  protected tableName = 'users';

  public async up() {
    this.schema.createTable(this.tableName, (table) => {
      table.uuid('id').primary();
      table.string('email').notNullable().unique();
      table.string('password').notNullable();
      table.string('remember_me_token').nullable();

      // Any extra fields would go here
      table.string('name').notNullable();

      table.timestamp('created_at', { useTz: true }).notNullable();
      table.timestamp('updated_at', { useTz: true }).notNullable();
      table.timestamp('deleted_at', { useTz: true }).nullable();
    });
  }

  public async down() {
    this.schema.dropTable(this.tableName);
  }
}
