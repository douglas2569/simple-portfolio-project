import { Component, Input, OnInit } from '@angular/core';
import Technology from 'src/app/models/Technology';

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
  technologies!:Array<Technology>

  constructor() { }

  ngOnInit(): void {}



}
