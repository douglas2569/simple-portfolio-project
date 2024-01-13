import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-skill',
  templateUrl: './skill.component.html',
  styleUrls: ['./skill.component.css']
})
export class SkillComponent implements OnInit { 
  @Input()
  icon!:string
  @Input()
  name!:string
  @Input()
  tags!:Array<string>

  constructor() { }

  ngOnInit(): void {}

  

}
