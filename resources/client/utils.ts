import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export const cx = (...inputs: ClassValue[]) => twMerge(clsx(inputs));
