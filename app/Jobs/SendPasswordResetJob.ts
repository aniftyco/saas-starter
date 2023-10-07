import Job from '@app/Jobs/Job';
import User from '@app/Models/User';
import Mail from '@ioc:Adonis/Addons/Mail';

export type Payload = {
  user: User;
  url: string;
};

export default class SendPasswordResetJob extends Job<Payload> {
  public async handle({ user, url }: Payload) {
    await Mail.send((message) => {
      message
        .from('noreply@example.com')
        .subject('Reset your password')
        .to(user.email)
        .htmlView('emails/password-reset', { user, url });
    });
  }
}
