import { DispatchOptions, Job, JobHandlerContract, Queue } from '@ioc:Rlanz/Queue';

export default abstract class BaseJob<Payload> implements JobHandlerContract {
  static async dispatch<Payload>(payload: Payload, options?: DispatchOptions) {
    return Queue.dispatch(`@app/Jobs/${this.name}` as any, payload, options);
  }

  constructor(public job: Job<Payload>) {}
  public abstract handle(payload: Payload): Promise<void>;
  public async failed() {}
}
