import { Component, OnInit } from '@angular/core';
import Project from '../../models/Project';
import Skill from '../../models/Skill';
import { SkillService } from '../../services/skill.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  skills!:Array<Skill>
  projects!:Array<Project>

  constructor(private skillService:SkillService) { }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.skillService.getskills().subscribe((response)=>{
      this.skills = response.data
    })

    // this.projects = dataBase.projects
  }

}
