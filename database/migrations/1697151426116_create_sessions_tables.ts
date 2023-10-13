import User from '@app/Models/User';
import Schema from '@ioc:Adonis/Lucid/Schema';

export default class CreateSessionsTable extends Schema {
  protected tableName = 'sessions';

  public async up() {
    this.schema.createTable(this.tableName, (table) => {
      table.text('id').primary().unique().notNullable();
      table.uuid('user_id').references(User.primaryKey).inTable(User.table);
      table.string('ip').notNullable();
      table.string('agent').notNullable();

      table.timestamp('created_at', { useTz: true }).notNullable();
      table.timestamp('updated_at', { useTz: true }).notNullable();
      table.timestamp('deleted_at', { useTz: true }).nullable();
    });
  }

  public async down() {
    this.schema.dropTable(this.tableName);
  }
}
