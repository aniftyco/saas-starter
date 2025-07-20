import { Fragment } from 'react';
import { Head } from '@inertiajs/react';

const SignIn = () => {
  return (
    <Fragment>
      <Head title="Sign In" />
      <div className="flex min-h-screen items-center justify-center bg-gray-100 dark:bg-gray-900">
        <h1 className="text-4xl font-bold text-gray-800 dark:text-gray-100">Welcome to Our Application!</h1>
      </div>
    </Fragment>
  );
};

export default SignIn;
