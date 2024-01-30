import { Component, OnInit } from '@angular/core';
import Project from '../../models/Project';
import Skill from '../../models/Skill';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  skills!:Array<Skill>
  projects!:Array<Project>

  constructor() { }

  ngOnInit(): void {

  }

  mount():void{
    // this.skills = dataBase.skills
    // this.projects = dataBase.projects
  }

}
