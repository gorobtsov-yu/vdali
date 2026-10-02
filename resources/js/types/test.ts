import { TestQuestion } from "./testQuestion";

export interface IndexTest {
  id: number;
  name: string;
  code: string;
  description: string | null;
}

export interface Test {
  id: number;
  name: string;
  code: string;
  description: string | null;
  results_count: number;
  questions: TestQuestion[];
}