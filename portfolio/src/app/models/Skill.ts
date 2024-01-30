import Technology from './Technology'
export default interface Skill{
  id:string,
  icon:string,
  name:string,
  user_id:string,
  created_at:string,
  updated_at:string,
  technologies:Array<Technology>
}
