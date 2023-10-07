import User from '@app/Models/User';
import Schema from '@ioc:Adonis/Lucid/Schema';

export default class CreatePasswordResetsTable extends Schema {
  protected tableName = 'password_resets';

  public async up() {
    this.schema.createTable(this.tableName, (table) => {
      table.uuid('id').primary();
      table.uuid('user_id').references(User.primaryKey).inTable(User.table);
      table.string('token').notNullable();

      table.timestamp('created_at', { useTz: true }).notNullable();
    });
  }

  public async down() {
    this.schema.dropTable(this.tableName);
  }
}
