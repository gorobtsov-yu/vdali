import { TestAnswer } from "./testAnswer";

export interface TestQuestion {
  id: number;
  text: string;
  code: string;
  queue_position: number;
  answers: TestAnswer[];
}