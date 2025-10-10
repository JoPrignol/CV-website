import { Company } from './company';

export interface Experience {
    id: number;
    title: string;
    description: string;
    localisation: string;
    start_date: string;
    end_date: string | null;
    company: Company;
  }
