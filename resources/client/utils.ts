import { type ClassValue, clsx as _clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export const clsx = (...inputs: ClassValue[]) => twMerge(_clsx(inputs));
