import { School } from './school';

export interface Course {
    id: number;
    title: string;
    description: string | null;
    start_date: string | null;
    end_date: string | null;
    school: School;
  }
